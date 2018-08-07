<template>
      <div>      
          <table class="card" v-for="product in products" :key="product.id" >
                            <tbody>
                            <tr>
                                <th>
                                    Id.
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Description
                                </th>
                                
                            </tr>
                         <!--   <tr  v-for="product in products" :key="product.id">-->
                                <td>{{ product.id}}</td>
                                <td>
                                    {{ product.name }}
                                </td>
                                <td>
                                    {{ product.description }}
                                </td>
                               
                          <!--  </tr>-->
                            </tbody>
           </table>

        <!--form -->
       
<br>

              <form>
                    <div class="form-group">
                    <label for="productName">Product name</label>
                    <input type="text" v-model="product.name" class="form-control" id="productName" maxlength="32" placeholder="Enter product name">
                    </div>
                    <div class="form-group">
                    <label for="productDescription">Product description <small class="text-muted">(optional)</small></label>
                    <textarea class="form-control" v-model="product.description" id="productDescription" rows="3" maxlength="128" placeholder="Enter description"></textarea>
                    </div>
                    
                    <button type="submit" v-on:click.prevent="createProduct" class="btn btn-primary">Save product</button>
                </form>
                
             </div>            
 </template>



<script>

  import Productlist from './Productlist.vue';
    export default {
      component: {
          Productlist
      },
 
        data(){
            return {
            
                errors: [],
                 products: [],
               // update_product: {}
            }
        },
        mounted()
        {
            this.readProducts();
 
        },
        methods: {
           
            initAddProduct()
            {
               // $("#add_product_model").modal("show");
               
            },
             

            createProduct()
            {
                axios.post('http://medicare.test:82/product', {
                    name: this.product.name,
                    description: this.product.description,
                })
                    .then(response => {
 
                        this.reset();
 
                        this.Products.push(response.data.product);
 
                        $("#add_product_model").modal("hide");
 
                    })
                    .catch(error => {
                        this.errors = [];
                       /* if (error.response.data.errors.name) {
                            this.errors.push(error.response.data.errors.name[0]);
                        }
 
                        if (error.response.data.errors.description) {
                            this.errors.push(error.response.data.errors.description[0]);
                        }*/
                    });
            },
             readProducts()
            {
                axios.get('/product')
                    .then(response => {
 
                        this.products = response.data.Products;
 
                    });
            },
        }
    }
</script>
<style>

</style>
