import Vue from 'vue';
import VueResource from 'vue-resource';
import LogGraph from './components/LogGraph';

Vue.use(VueResource);

new Vue({
    el: 'body',
    components: {
        'log-graph': LogGraph
    }
});