Nova.booting((Vue, router, store) => {
  Vue.component('index-status-field', require('./components/IndexField'))
  Vue.component('detail-status-field', require('./components/DetailField'))
})
