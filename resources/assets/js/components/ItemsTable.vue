<template>
    <div>
        <form @submit.prevent="createItem">
            <div class="create-items-form input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                </div>
                <input v-model="newItemName" type="text" class="form-control" placeholder="Item Name" />
                <div class="input-group-prepend">
                    <span class="input-group-text">Location</span>
                </div>
                <select v-model="newItemLocationId" class="form-control">
                    <option value=""></option>
                    <option v-for="row in locations" :key="row.id" :value="row.id">{{ row.name }}</option>
                </select>
                <div class="input-group-prepend">
                    <span class="input-group-text">Category</span>
                </div>
                <categories-options ref="cats" v-model="newItemCategoryId"></categories-options>
                <div class="input-group-prepend">
                    <span class="input-group-text">Price</span>
                </div>
                <input v-model="newItemPrice" type="text" class="form-control" placeholder="Item Name" />
                <div class="input-group-append">
                    <button class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <th>ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Category</th>
                <th>Price</th>
                <th></th>
            </thead>
            <tbody>
                <tr v-for="row in items" :key="row.id">
                    <td>{{ row.id }}</td>
                    <td>{{ row.name }}</td>
                    <td>{{ row.location !== null ? row.location.name : '' }}</td>
                    <td>{{ row.category !== null ? row.category.name : '' }}</td>
                    <td>{{ row.price }}</td>
                    <td align="center"><button class="btn btn-danger btn-sm" @click.prevent="deleteItem(row.id)"><i class="fa fa-times" /> Delete</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            items: [],
            locations: [],
            newItemName: '',
            newItemPrice: 0.00,
            newItemCategoryId: null,
            newItemLocationId: null
        };
    },
    mounted() {
        this.getItems();
        this.getLocations();
    },
    methods: {
        getItems() {
            return axios.get('/api/items')
                .then(response => {
                    this.items = response.data;
                }).catch(console.error);
        },
        getLocations() {
            return axios.get('/api/locations')
                .then(response => {
                    this.locations = response.data;
                }).catch(console.error);
        },
        createItem() {
            return axios.post('/api/items', {
                    name: this.newItemName,
                    category: this.newItemCategoryId,
                    location: this.newItemLocationId,
                    price: this.newItemPrice
                })
                .then(this.getItems)
                .then(() => {
                    this.newItemName = '';
                    this.newItemPrice = 0.00;
                    this.newItemLocationId = null;
                    this.newItemCategoryId = null;
                    this.$refs.cats.reset();
                })
                .catch((error) => {
                    let errors = [];
                    for (const key in error.response.data) {
                        if (error.response.data.hasOwnProperty(key)) {
                            const e = error.response.data[key];
                            errors.push(e[0]);
                        }
                    }
                    alert(errors.join("\n"))
                });
        },
        deleteItem(id) {
            return axios.post('/api/items/' + id, {_method: 'DELETE'})
                .then(this.getItems)
                .catch(console.error);
        }
    }
}
</script>

<style>
.create-items-form {
    margin-bottom: 10px;
}
</style>