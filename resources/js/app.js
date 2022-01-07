import { createApp, h } from "vue";
import { createInertiaApp, Head, Link } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import Layout from "./Shared/Layout";

createInertiaApp({
    resolve: async (name) => {
        let page = (await import(`./Pages/${name}`)).default;
        
        if (page.layout === undefined) {
            page.layout = Layout
        }

        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .component("Head", Head)
            .component("Link", Link)
            .use(plugin)
            .mount(el);
    },

    title: (title) => `My App - ${title}`,
});

InertiaProgress.init({
    color: "red",
    showSpinner: true,
});
