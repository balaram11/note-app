/*
    contains  routes for the application
 */

/*
    import vue and vue route
 */

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Note from './views/Note.vue'
import Tag from './views/Tag.vue'

export default new VueRouter({
    linkExactActiveClass:'active',
    routes:[
        {
            path: '/notes',
            name: 'notes',
            component: Note
        },
        {
            path: '/tags',
            name: 'tags',
            component: Tag
        },
    ]
});