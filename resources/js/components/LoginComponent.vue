<template>
    <div id="wrapper">
        <div class="row form-group">
            <label class="col-2 col-form-label">Product naam</label>
            <div class="col-3">
                <input v-model="newProduct" class="form-control" type="text">
            </div>
            <button class="btn btn-primary" v-on:click="addProduct()">Voeg product toe</button>
        </div>
        <div class="row form-group">
            <label class="col-2 col-form-label">Zoek product</label>
            <div class="col-6">
                <input v-model="searchProduct" class="form-control" type="text">
            </div>
        </div>
        <div class="row">
            <div id="cards" class="col-8">
                <div class="card" v-for="item in filterProducts">
                    <div class="card-body">
                        <p v-if="item.status === false" v-on:click="toggleItemStatus(item)" class="card-name">Name: {{item.name}}</p>
                        <input v-else autofocus type="text" v-model="item.name" v-on:keyup.enter="toggleItemStatus(item)" v-on:blur="toggleItemStatus(item)">
                        <p class="card-id">Id: {{item.id}}</p>
                    </div>
                    <button v-on:click="deleteProduct(item.id)" class="card-delete">X</button>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import axios from 'axios';

    export default {
        name: 'items',
        mounted() {
            console.log('mounted');
            this.getProducts();
        },
        data: function() {
            return {
                newProduct: '',
                Products : [],
                searchProduct: '',
            }
        },
        methods: {
            getProducts: function () {
                axios.get("http://blog.local/api/products/all").then((response) => {
                    // this.Products = response.data;
                    console.log(this.Products);
                    this.pushProductsToArray(response);
                }, (error) => {
                    console.log(error);
                });
            },
            pushProductsToArray: function (response) {
                var products = response.data;

                products.forEach(function (product) {
                    Vue.set(product, 'status', false);
                });

                this.Products = products;
            },
            addProduct: function() {
                axios.post("http://blog.local/api/products/store", {
                    'name': this.newProduct
                }).then((response) => {
                    this.Products.push({'name': this.newProduct, 'id': response.data});
                });
            },
            deleteProduct: function (id) {
                axios.delete("http://blog.local/api/products/delete", { data: {
                    'id': id,
                }}).then((response) => {

                    let i = this.Products.map(product => product.id).indexOf(id); // find index of your object
                    this.Products.splice(i, 1);

                }, (error) => {
                    console.log(error);
                });
            },
            toggleItemStatus: function (product) {
                product.status = !product.status;
            },
            updateProduct: function (id) {

            }


        },
        computed: {
            filterProducts: function () {
                return this.Products.slice(0).reverse().filter(product => {
                    return product.name.includes(this.searchProduct);
                });
            }
        },
    }
</script>

<style scoped lang="scss">
#wrapper {
    #cards {
        /*overflow-y: scroll;*/
        /*max-height: 500px;*/
    }

    .btn-primary {
        min-width: 163px;
    }
}

.card {
    margin-bottom: 40px;
    .card-name{
        float: left;
        width: 100%;
        display: inline-block;
    }
    .card-delete {
        position: absolute;
        top: -10px;
        right: -10px;
        background-color: darkgrey;
        width: 20px;
        height: 20px;
        border: 2px solid grey;
        border-radius: 100%;
    }
}
</style>
