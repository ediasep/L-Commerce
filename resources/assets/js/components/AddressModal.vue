<script>
  export default {
    name: 'modal',
    props: ['myText'],
    data: function () {
    	return {
    		searchQuery: '',
    		addressList: null,
    		activeItem: null,
    	}
    },
    methods: {
    	searchAddress: function() {
    		this.activeItem = null;

	        window.axios.get('/address-api/search/' + this.searchQuery).then(({ data }) => {
	          this.addressList = data;
	        });
    	},

    	setActiveItem: function(itemId) {
    		this.activeItem = itemId;
    	},

    	setMainAddress: function() {
    		this.$emit('itemClicked', this.activeItem);
    	},

    	isActive: function(itemId) {
    		if(this.activeItem == itemId) {
    			return true;
    		}

    		return false;
    	}
    },
    computed: {
    	addresses: function() {
    		if(this.addressList == null || this.searchQuery == '') {
    			return this.myText;
    		} else {
    			return this.addressList;
    		}
    	}
    }
  };
</script>

<template>
	<div tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" class="modal fade bd-example-modal-lg">

		<div class="modal-dialog">

			<div class="modal-content rounded-0">

				<div class="modal-header">
					<h5 id="exampleModalLabel" class="modal-title">Pick an Address or 
						<a href="#">Create New</a>
					</h5> 
					<button type="button" data-dismiss="modal" aria-label="Close" class="close">
						<span aria-hidden="true">×</span>
					</button>
				</div>

				<div class="modal-body">

					<!-- Search Input -->
					<input type="text" @input="searchAddress" v-model="searchQuery" class="form-control" placeholder="Search Address" />
					<br>
					<!-- Search Input -->

					<!-- Address List -->
					<div class="list-group">
					  <a v-for="address in addresses" href="#" @click="setActiveItem(address.id)" class="list-group-item list-group-item-action rounded-0" :class="{ 'active' : isActive(address.id)}">

					    <div class="d-flex w-100 justify-content-between">
					      <span>
						      <h5 class="mb-1">{{ address.address_name }}</h5>
					      </span>

					      <small v-if="address.is_main_address == true">
							Main Address
					      </small>
					    </div>
					    <p class="mb-1">{{ address.full_address }}</p>
					    <small>{{ address.post_code }}</small>
					  </a>
					</div>
					<!-- Address List -->

		      	</div>

		      	<div class="modal-footer">
		      		<button @click="setMainAddress" data-dismiss="modal" class="btn btn-primary btn-flat">Use this address</button>
		      	</div>
	  		</div>
	  	</div>

	</div>
</template>
