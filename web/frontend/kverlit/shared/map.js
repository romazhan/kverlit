const pagesPath = 'kverlit/pages';

const map = {
    '404': {
        name: 'Not Found',
        template: `${pagesPath}/404.html`
    },

    '/': {
        name: 'Welcome',
        template: `${pagesPath}/welcome.html`
    },

    '/register': {
        name: 'Register',
        template: `${pagesPath}/register.html`
    },

    '/login': {
        name: 'Login',
        template: `${pagesPath}/login.html`
    },

    '/feed': {
        name: 'Feed',
        template: `${pagesPath}/feed.html`
    },

    '/search': {
        name: 'Search',
        template: `${pagesPath}/search.html`
    },

    '/profile': {
        name: 'Profile',
        template: `${pagesPath}/profile.html`
    }
};

export { map };
