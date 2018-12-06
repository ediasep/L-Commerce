<script>
  import addressModal from './AddressModal.vue';
  import addressView from './AddressView.vue';
  export default {
    name: 'app',
    components: {
      addressModal,
      addressView
    },
    data () {
      return {
         text : "",
         address_id: "",
         address_name: "",
         full_address: "",
         post_code: ""
      };
    },
    methods: {
      showAddresses() {
        window.axios.get('/address-api').then(({ data }) => {
          this.text = data;
        });
      },
      setActiveAddress(activeItem) {
        window.axios.get('/address-api/byid/' + activeItem).then(({ data }) => {
          this.address_id   = data.id;
          this.address_name = data.address_name;
          this.full_address = data.full_address;
          this.post_code    = data.post_code;
        });
      }
    },
    created: function() {
      window.axios.get('/address-api/mainaddress').then(({ data }) => {
          this.address_id    = data.id;
          this.address_name  = data.address_name;
          this.full_address  = data.full_address;
          this.post_code     = data.post_code;
      });
    }
  };
</script>

<template>
  <div id="app">
    <addressView 
          :address_id=address_id
          :address_name=address_name 
          :full_address=full_address 
          :post_code=post_code 
    />

    <a href="#" @click="showAddresses" data-toggle="modal" data-target=".bd-example-modal-lg">Use another address</a>

    <addressModal :myText=text @itemClicked="setActiveAddress"/>
  </div>
</template>
