require('./bootstrap');
import { createApp, h } from 'vue'
import { createInertiaApp, Link, Head } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import Layout from './Shared/Layout'

InertiaProgress.init()
createInertiaApp({

  resolve: name => {
    let page = require(`./Pages/${name}`).default;

    if (page.layout == undefined) {
      page.layout = Layout
    }

    if (page.__file.includes('Auth')) {
        page.layout = null
    }

    return page;
  },


  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .component("Link", Link)
      .component("Head", Head)
      .mount(el)
  },

  title: title => `In Reach - ${title}`

});

InertiaProgress.init({
  color: "#55b0b5",
  showSpinner: true,
});
