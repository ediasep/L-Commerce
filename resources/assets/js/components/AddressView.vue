<script>
export default {
	name: 'AddressView',
    props: ['address_id','address_name', 'full_address', 'post_code'],
}
</script>

<template>
	<span>
		<input type="hidden" name="billing_address_id" :value="address_id" />

		<b class="text-muted">
			{{ address_name }}
		</b>
		<p class="text-muted">
			{{ full_address }} <br>
			<small>{{ post_code }}</small>
		</p>
	</span>
</template>