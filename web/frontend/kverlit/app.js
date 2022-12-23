import { App, Mapper } from '/frontend/framework/index.js';
import { map } from '/frontend/kverlit/shared/map.js';

const rootElement = document.body.querySelector('kve-root');

const mapper = new Mapper(map).mount(rootElement);
const app = new App(mapper);

document.addEventListener('DOMContentLoaded', () => app.init());
