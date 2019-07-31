<template>
    <div>
        <form @submit.prevent="createCategory">
            <div class="create-categories-form input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                </div>
                <input v-model="newCategoryName" type="text" class="form-control" placeholder="Category Name" />
                <div class="input-group-prepend">
                    <span class="input-group-text">Parent Category</span>
                </div>
                <categories-options ref="cats" v-model="newParentId" v-bind:provided-categories="categories"></categories-options>
                <div class="input-group-append">
                    <button class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <th>ID</th>
                <th>Name</th>
                <th>Parent</th>
                <th></th>
            </thead>
            <tbody>
                <tr v-for="row in categories" :key="row.id">
                    <td>{{ row.id }}</td>
                    <td>{{ row.name }}</td>
                    <td>{{ row.parent !== null ? row.parent.name : '' }}</td>
                    <td align="center"><button class="btn btn-danger btn-sm" @click.prevent="deleteCategory(row.id)"><i class="fa fa-times" /> Delete</button></td>
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
            categories: [],
            newCategoryName: '',
            newParentId: null
        };
    },
    mounted() {
        this.getCategories();
    },
    methods: {
        getCategories() {
            return axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data;
                    this.$refs.cats.setCategories(this.categories);
                }).catch(console.error);
        },
        createCategory() {
            return axios.post('/api/categories', {name: this.newCategoryName, parent_id: this.newParentId})
                .then(this.getCategories)
                .then(() => {
                    this.newCategoryName = '';
                    this.newParentId = null;
                })
                .catch(console.error);
        },
        deleteCategory(id) {
            return axios.post('/api/categories/' + id, {_method: 'DELETE'})
                .then(this.getCategories)
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