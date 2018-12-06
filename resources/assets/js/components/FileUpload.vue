<template>
    <span>
        <input type="file" name="image" id="file" v-on:change="onFileChange" class="inputfile">
        <label for="file" v-bind:style="{ 'background-image': 'url(' + image + ')' }"><i class="fa fa-plus-circle"></i></label>
    </span>
</template>
<style scoped>
    img{
        height: 200px;
        margin-bottom: 7.9px;
    }

    .inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }

    .inputfile + label {
        font-size: 1.25em;
        font-weight: 700;
        color: white;
        background-color: #E9ECEF;
        padding: 50px;
        display: inline-block;
        cursor: pointer;
        background-size: cover;
    }

    .inputfile:focus + label,
    .inputfile + label:hover {
        background-color: #38C172ed;
    }

    .hidden {
        display: none !important;
    }
</style>
<script>
    export default{
        props: ['image'],

        data(){
            return {
                image: ''
            }
        },

        methods: {
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    }
</script>