require('./bootstrap');

import FormWrapper from './components/FormWrapper'
import GroupSelection from './components/GroupSelection'

const app = new Vue({
    el: '#app',
    components: {
        FormWrapper,
        GroupSelection
    }
})
