"use strict";(self.webpackChunkaddons=self.webpackChunkaddons||[]).push([[745],{7745:(t,e,n)=>{n.r(e),n.d(e,{default:()=>s});const o={name:"taxonomy-fieldtype-settings",mixins:[{props:{value:{type:Object,required:!0}},computed:{settings:{get:function(){return this.value.settings||{}},set:function(t){this.$set(this.value.settings,t)}},errors:function(){return this.value.errors||{}}}}],data:function(){return{taxonomies:[]}},computed:{options:function(){return _.map(this.taxonomies,(function(t){return{label:t.name,value:t.id}}))}},created:function(){var t=this;axios.get("/api/taxonomies").then((function(e){return t.taxonomies=e.data.data}))}};const s=(0,n(1900).Z)(o,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"row"},[n("ui-select-group",{staticClass:"col w-full sm:w-1/2",attrs:{name:"taxonomy",label:"Taxonomy",help:"The taxonomy from which to show terms.",autocomplete:"off",options:t.options,"has-error":t.errors.has("settings.taxonomy"),"error-message":t.errors.get("settings.taxonomy")},model:{value:t.settings.taxonomy,callback:function(e){t.$set(t.settings,"taxonomy",e)},expression:"settings.taxonomy"}})],1)}),[],!1,null,null,null).exports},1900:(t,e,n)=>{function o(t,e,n,o,s,r,i,a){var u,c="function"==typeof t?t.options:t;if(e&&(c.render=e,c.staticRenderFns=n,c._compiled=!0),o&&(c.functional=!0),r&&(c._scopeId="data-v-"+r),i?(u=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),s&&s.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(i)},c._ssrRegister=u):s&&(u=a?function(){s.call(this,(c.functional?this.parent:this).$root.$options.shadowRoot)}:s),u)if(c.functional){c._injectStyles=u;var l=c.render;c.render=function(t,e){return u.call(e),l(t,e)}}else{var d=c.beforeCreate;c.beforeCreate=d?[].concat(d,u):[u]}return{exports:t,options:c}}n.d(e,{Z:()=>o})}}]);