import {
    getUrlPath, setUrl, httpGet, delegate
} from '../utils/index.js';

import { createKvelement } from './kvelement.js';

class Mapper {
    constructor(map) {
        this._map = map;
    }

    _bindPopState() {
        window.addEventListener('popstate', () => this._handleCurrentUrl());
    }

    _getMapPath(url) {
        return this._map[url] || this._map['404'] || null;
    }

    _clickHandler() {
        return delegate('a', e => {
            e.preventDefault();

            const url = e.target.getAttribute('href');
            setUrl(url);

            this._handleUrl(url);
        })
    }

    async _createPageKvelement(mapPath) {
        const pageContent = await httpGet(mapPath.template);

        const kvelement = createKvelement(mapPath.name, pageContent, {
            click: this._clickHandler()
        });

        this._root.innerHTML = kvelement.tag;
    }

    _handleUrl(url) {
        const mapPath = this._getMapPath(url);
        if(!mapPath) return;

        this._createPageKvelement(mapPath);
    }

    _handleCurrentUrl() {
        const url = getUrlPath();
        this._handleUrl(url);
    }

    init() {
        this._bindPopState();
        this._handleCurrentUrl();
    }

    mount(element) {
        this._root = element;

        return this;
    }
};

export { Mapper };
