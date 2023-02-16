
window.Fusion.booting(function(Vue, router, store) {
	Vue.component('extended-matrix-fieldtype', () => import('./ExtendedMatrixFieldtype/Field'))
	Vue.component('extended-matrix-fieldtype-settings', () => import('./ExtendedMatrixFieldtype/Settings'))
})