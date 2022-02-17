import IndexField from "./components/IndexField.vue";
import DetailField from "./components/DetailField.vue";

Nova.booting((Vue, router, store) => {
  Vue.component('index-status-field', IndexField)
  Vue.component('detail-status-field', DetailField)
})
