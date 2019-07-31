<template>
    <div style="display: inline-block;">
        <select v-model="categoryId" 
            v-on:input="$emit('input', parseInt($event.target.value))" class="form-control">
            <option v-for="row in categories" :key="row.id" :value="row.id">{{ row.name }}</option>
        </select>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        providedCategories: null
    },
    data() {
        return {
            categories: [],
            categoryId: null
        };
    },
    mounted() {
        if (!this.providedCategories) {
            this.getCategories();
        } else {
            this.setCategories(this.providedCategories);
        }
    },
    methods: {
        getCategories() {
            return axios.get('/api/categories')
                .then(response => {
                    this.setCategories(response.data);
                }).catch(console.error);
        },
        setCategories(categories) {
            this.categories = categories;
        }
    }
}
</script>