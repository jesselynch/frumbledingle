<template>
    <div>
        <form @submit.prevent="getReport">
            <div class="report-form input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Prce</span>
                </div>
                <input v-model="price" type="text" class="form-control" placeholder="Minimum price" />
                <div class="input-group-append">
                    <button class="btn btn-primary">Run</button>
                </div>
            </div>
        </form>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <th>Location</th>
                <th>Parent Category</th>
                <th>Category</th>
                <th>Count</th>
            </thead>
            <tbody>
                <tr v-for="(row, index) in reportData" :key="index">
                    <td>{{ row.location }}</td>
                    <td>{{ row.parent_category }}</td>
                    <td>{{ row.category }}</td>
                    <td>{{ row.item_count }}</td>
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
            reportData: [],
            price: 0.00,
        };
    },
    mounted() {
    },
    methods: {
        getReport() {
            return axios.post('/api/report', {
                    price: this.price
                })
                .then(response => {
                    this.reportData = response.data;
                }).catch(console.error);
        }
    }
}
</script>

<style>
.report-form {
    margin-bottom: 10px;
}
</style>