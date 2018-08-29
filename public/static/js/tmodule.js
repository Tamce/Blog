(function (global, factory) {
    global.tmodule = factory(global.jQuery);
})(this, function ($) {
if (!$) {
    console.error('JQuery Required!');
    return;
}
module = {};
module.loadComponent = (name, resolve) => {
    console.log(`[tmodule] Loading component '${name}'`);
    $.get(`/modules/${name}`).then(data => {
        let dom = $(`<div>${data}</div>`);
        let component = {};
        // Ensure that the script will not be interrupted if the component does not has a <script> tag
        try {
            component = $('script', dom).html().replace(/\s(export\sdefault)\s/, '');
            component = eval(`(${component})`);
        } catch (e) {
            console.warn(`[tmodule] Script tag empty or error while loading component '${name}', ignoring...`);
        }
        component.template = $('template', dom).html();
        // For the time being, Just Inject style tag into <head>
        $('head').append($('style', dom));
        console.log(`[tmodule] Component '${name}' loaded.`);
        resolve(component);
    }).catch(e => {
        console.error(`[tmodule] Error while loading component '${name}', aborting...`, e)
    });
}
module.lazyComponent = (name) => (resolve) => module.loadComponent(name, resolve);
return module;
});
