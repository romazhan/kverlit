import { App, Mapper } from '/frontend/framework/index.js';
import { map } from '/frontend/kverlit/shared/map.js';

const rootElement = document.body.querySelector('kve-root');
const kvelementsPath = '/frontend/kverlit/kvelements';

const mapper = new Mapper(map).mount(rootElement);
const app = new App(mapper, {
    'for-user': `${kvelementsPath}/head/kve-for-user.html`,
    'for-guest': `${kvelementsPath}/head/kve-for-guest.html`,
});

document.addEventListener('DOMContentLoaded', () => app.init());
