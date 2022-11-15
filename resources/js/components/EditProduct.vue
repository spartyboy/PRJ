<template>
    <div>
        <h3 class="text-center">Edit Product {{product.name}}</h3>
        <div class="row">
            <div class="col-md-6">
                <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
                <form @submit.prevent="updateProduct">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="product.name">
                    </div>
                    <div class="form-group">
                        <label>Detail</label>
                        <input type="text" class="form-control" v-model="product.detail">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                product: {},
                detail:'',
                name:'',
                validationErrors: ''
            }
        },
        created() {
            this.axios
                .get(`http://localhost:8000/api/products/${this.$route.params.id}`)
                .then((res) => {
                    console.log(res.data);
                    this.product = res.data;
                });
        },
        methods: {
            updateProduct() {
                this.axios
                    .patch(`http://localhost:8000/api/products/${this.$route.params.id}`, this.product)
                    .then((res) => {
                        this.$router.push({ name: 'home' });
                    }) .catch(error =>{
                    if (error.response.status == 422) {
                        this.validationErrors = error.response.data.errors;
                    }
                });
            }
        }
    }
</script>
