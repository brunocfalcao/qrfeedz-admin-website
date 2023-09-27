import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-nova-address-finder', IndexField)
  app.component('detail-nova-address-finder', DetailField)
  app.component('form-nova-address-finder', FormField)
})
