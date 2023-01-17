import { PREFIX } from '../shared/contract.js';
import { Observer } from './observer.js';
import {
    $, textToHtml, toTagSyntax, storage,
    router, cookie, pubsub, httpPost
} from '../utils/index.js';

const getKvelement = normalizedKvelementName => (customElements.get(normalizedKvelementName) || {}).prototype;

const normalizeKvelementName = kvelementName => {
    if(kvelementName.includes(`${PREFIX}-`)) return kvelementName;

    return `${PREFIX}-${kvelementName.toLowerCase().replace(' ', '-')}`;
};

const createKvelement = (kvelementName, textContent, events = {}) =>{
    const normalizedKvelementName = normalizeKvelementName(kvelementName);

    const kvelement = getKvelement(normalizedKvelementName);
    if(kvelement) return kvelement;

    const kvelementTag = toTagSyntax(normalizedKvelementName);

    customElements.define(normalizedKvelementName, class extends HTMLElement {
        constructor() {
            super();
            this.attachShadow({mode: 'open'});

            this._observer = this._initObserver();

            this._bindEvents(events);
        }

        get tag() {
            return kvelementTag;
        }

        connectedCallback() {
            this._compileAndConnect(textToHtml(textContent));
        }

        _compileAndConnect(html) {
            const scriptEl = html.querySelector('script');
            if(!scriptEl) {
                this.shadowRoot.appendChild(html);
                return;
            }

            scriptEl.remove();

            const scriptText = `(async () => {${scriptEl.textContent}})();`;
            const scriptFn = new Function(scriptText);

            this.shadowRoot.appendChild(html);
            scriptFn.call(this._context);
        }

        _bindEvents(events) {
            if(!events) return;

            Object.keys(events).forEach(eventName => {
                this.shadowRoot.addEventListener(eventName, events[eventName]);
            });
        }

        _initObserver() {
            const observer = new Observer();
            observer.observe(this, {attributes: true});

            return observer;
        }

        _onAttrChange(name, callback) {
            this._observer.pushAttributeHandler((attrName, newValue) => {
                if(attrName !== name) return;

                callback(newValue);
            });
        }

        get _context() {
            const features = {
                $: $(this.shadowRoot),
                root: this.shadowRoot,
                attrs: this._attributes
            };

            const methods = {
                require: url => import(url).then(_ => _),
                onProp: this._onAttrChange.bind(this),
                emit: pubsub.pub,
                on: (eventName, callback) => pubsub.sub(eventName, callback, true)
            };

            const tools = {storage, router, cookie, httpPost};

            return {
                ...features,
                ...methods,
                ...tools
            };
        }

        get _attributes() {
            return this.getAttributeNames().reduce((attrObj, cAttrName) => {
                attrObj[cAttrName] = this.getAttribute(cAttrName);
                return attrObj;
            }, {});
        }
    });

    return getKvelement(normalizedKvelementName);
};

export { createKvelement };
