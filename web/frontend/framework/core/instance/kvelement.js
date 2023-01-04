import { PREFIX } from '../shared/contract.js';

import { textToHtml, toTagSyntax } from '../utils/index.js';

const normalizeKvelementName = kvelementName => `${PREFIX}-${kvelementName.toLowerCase().replace(' ', '-')}`;

const getKvelement = normalizedKvelementName => (customElements.get(normalizedKvelementName) || {}).prototype;

const createKvelement = (kvelementName, textTemplate, events = {}) => {
    const normalizedKvelementName = normalizeKvelementName(kvelementName);

    const kvelement = getKvelement(normalizedKvelementName);
    if(kvelement) return kvelement;

    const kvelementTag = toTagSyntax(normalizedKvelementName);

    customElements.define(normalizedKvelementName, class extends HTMLElement {
        constructor() {
            super();
            this.attachShadow({mode: 'open'});

            this._bindEvents(events);
        }

        get _context() {
            return {
                root: this.shadowRoot,
                require: url => import(url).then(_ => _)
            };
        }

        _bindEvents(events) {
            if(!events) return;

            Object.keys(events).forEach(eventName => {
                this.shadowRoot.addEventListener(eventName, events[eventName]);
            });
        }

        _compileAndConnect(html) {
            const scriptEl = html.querySelector('script');
            if(!scriptEl) {
                this.shadowRoot.appendChild(html);
                return;
            }

            scriptEl.remove();

            const scriptText = `(async () => {
                ${scriptEl.textContent}
            })();`;
            const scriptFn = new Function(scriptText);

            this.shadowRoot.appendChild(html);

            scriptFn.call(this._context);
        }

        connectedCallback() { 
            this._compileAndConnect(textToHtml(textTemplate));
        }

        get tag() {
            return kvelementTag;
        }
    });

    return getKvelement(normalizedKvelementName);
};

export { createKvelement };
