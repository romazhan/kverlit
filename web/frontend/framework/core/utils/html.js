const $ = context => selector => {
    const el = context.querySelector(selector);

    if(el) {
        el.$ = $(el);
        el.on = (e, handler) => el.addEventListener(e, handler);
    }

    return el;
};

const delegate = (selector, handler) => e => e.target.closest(selector) && handler(e);

const textToHtml = text => new Range().createContextualFragment(text);

const toTagSyntax = elName => `<${elName}></${elName}>`;

export { $, delegate, textToHtml, toTagSyntax };
