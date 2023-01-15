import { App, Mapper } from '/frontend/framework/index.js';
import { kvelements } from '/frontend/kverlit/shared/kvelements.js';
import { map } from '/frontend/kverlit/shared/map.js';

const rootElement = document.body.querySelector('kve-root');

const mapper = new Mapper(map).mount(rootElement);
const app = new App(mapper, kvelements);

document.addEventListener('DOMContentLoaded', () => {
    app.init(() => console.log('App initialized'));
});
