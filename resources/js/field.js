import IndexField from "./components/IndexField";
import DetailField from "./components/DetailField";
import Popper from "vue3-popper";

Nova.booting((app, store) => {
  app.component('index-status-field', IndexField)
  app.component('detail-status-field', DetailField)
  app.component('popper', Popper)
})
