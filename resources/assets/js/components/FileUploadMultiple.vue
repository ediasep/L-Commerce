<template>
    <span>
        <input type="file" name="images[]" id="file" v-on:change="onFileChange" class="inputfile">
        <label for="file" @click="onClick" inputId="1" v-bind:style="{ 'background-image': 'url(' + image + ')' }"><i class="fa fa-plus-circle"></i></label>

        <input type="file" name="images[]" id="file2" v-on:change="onFileChange" class="inputfile">
        <label for="file2" @click="onClick" inputId="2" v-bind:style="{ 'background-image': 'url(' + image2 + ')' }"><i class="fa fa-plus-circle"></i></label>

        <input type="file" name="images[]" id="file3" v-on:change="onFileChange" class="inputfile">
        <label for="file3" @click="onClick" inputId="3" v-bind:style="{ 'background-image': 'url(' + image3 + ')' }"><i class="fa fa-plus-circle"></i></label>

        <input type="file" name="images[]" id="file4" v-on:change="onFileChange" class="inputfile">
        <label for="file4" @click="onClick" inputId="4" v-bind:style="{ 'background-image': 'url(' + image4 + ')' }"><i class="fa fa-plus-circle"></i></label>

        <input type="file" name="images[]" id="file5" v-on:change="onFileChange" class="inputfile">
        <label for="file5" @click="onClick" inputId="5" v-bind:style="{ 'background-image': 'url(' + image5 + ')' }"><i class="fa fa-plus-circle"></i></label>
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
        props: ['images'],

        data(){
            return {
                image: '',
                image2: '',
                image3: '',
                image4: '',
                image5: '',
                inputId: ''
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
                    if(vm.inputId == 1) {
                        vm.image = e.target.result;
                    } else if(vm.inputId == 2) {
                        vm.image2 = e.target.result;
                    } else if(vm.inputId == 3) {
                        vm.image3 = e.target.result;
                    } else if(vm.inputId == 4) {
                        vm.image4 = e.target.result;
                    } else if(vm.inputId == 5) {
                        vm.image5 = e.target.result;
                    }
                };
                reader.readAsDataURL(file);
            },
            onClick(e) {
                this.inputId = e.target.getAttribute('inputId');
            }
        },
        created: function() {
            var images = JSON.parse(this.images);

            for(var i = 0; i < images.length; i++) {
                if(i == 0) {
                    this.image = images[i].url;
                } else if(i == 1) {
                    this.image2 = images[i].url;
                } else if(i == 2) {
                    this.image3 = images[i].url;
                } else if(i == 3) {
                    this.image4 = images[i].url;
                } else {
                    this.image5 = images[i].url;
                }
            }
        }
    }
</script>