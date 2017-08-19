(function (global, factory) {
    global.tmodule = factory(global.jQuery);
})(this, function ($) {
if (!$) {
    console.error('JQuery Required!');
    return;
}
module = {};
module.loadComponent = (name, uri) => {
    console.log(`[tmodule] loading component (${name}, ${uri})`);
    // ajax load component
    return {
        template: `<div>Component ${name}</div>`
    }
}
module.lazyComponent = (name, uri) => (resolve) => resolve(module.loadComponent(name, uri));
module.routes = [
    {
        name: 'blog',
        path: '/blog',
        component: module.lazyComponent('blog', '')
    }, {
        name: 'home',
        path: '/',
        component: {
            template: '<div>Home</div>'
        }
    }, {
        name: 'login',
        path: '/login',
        component: {
            template: '<div>Login</div>'
        }
    }, {
        name: 'post',
        path: '/post/:hash',
        component: {
            template: '<div>Post {{$route.params.hash}}</div>'
        }
    }
];
return module;
});