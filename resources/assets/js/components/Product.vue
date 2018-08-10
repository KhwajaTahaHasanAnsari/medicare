<template>
  <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                        <div class="panel-heading">
                            <button @click="initAddProduct()" class="btn btn-primary btn-xs pull-right" >
                                + Add New product
                            </button>
                                product
                         </div>
 
                    <div class="panel-body">
                                <!--  {{csrf_field()}}-->
                            <table class="table table-bordered table-striped table-responsive">
                                <tbody>
                                <tr>
                                    <th>
                                        No.
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                                <tr  v-for="product in products" :key="product.id">
                                    <td>{{ product.id}}</td>
                                    <td>
                                        {{product.name }}
                                    </td>
                                    <td>
                                        {{product.description }}
                                    </td>
                                    <td>
                                     <button @click="initUpdate(product)" class="btn btn-success btn-xs">Edit</button>
                                    <button @click="deleteTask(product.id)" class="btn btn-danger btn-xs">Delete</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
 
        <div class="modal fade" tabindex="-1" role="dialog" id="add_task_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add New Product</h4>
                    </div>
                    <div class="modal-body">

 
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" placeholder="Product Name" class="form-control"
                                   v-model="product.name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control"
                                      placeholder="Product Description" v-model="product.description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="createProduct" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
 

        <div class="modal fade" tabindex="-1" role="dialog" id="update_task_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Update Product</h4>
                    </div>
                    <div class="modal-body">
 
                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>
 
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" placeholder="Product Name" class="form-control" id="e_prod_name">
                            <input type="hidden" placeholder="Product Name" class="form-control" id="e_prod_id">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea cols="30" rows="5" class="form-control"
                                      placeholder="Product Description" id="e_prod_desc"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="update_product" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
  </div>       


<script>

  import Productlist from './Productlist.vue';
    export default {
      component: {
          Productlist
      },
 
        data(){
            return {
              product: {
                    id:'',
                    name: '',
                    description: ''
                },
                errors: [],
                products: [],
                update_product: []
            }
        },
        mounted()
        {
            this.readProducts();
 
        },
        methods: {

            initAddProduct()
            {
                $("#add_product_model").modal("show");
               
            },
            createProduct()
            {
                axios.post('http://medicare.test:82/product', {
                    name: this.product.name,
                    description: this.product.description,
                })
                    .then(response => {
 
                        this.reset();
 
                        this.products.push(response.data.product);
 
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
             reset()
            {
                this.product.name = '';
                this.product.description = '';
            },
             readProducts()
            {
                axios.get('/product')
                    .then(response => {
 
                        this.products = response.data.products;
 
                    });
            },
           /*  initUpdate(prodcut)
            {   
                
                console.log("inside update method");
                console.log(prodcut);
                this.errors = [];
                 this.update_product.productIndex = this.products[prodcut.Id];
                $('#e_prod_name').val(prod.name);
                $('#e_prod_desc').val(prod.description);
                $('#e_prod_id').val(prod.id);

                $("#update_product_model").modal("show");
        
            },
            update_product()
            {
                axios.patch('http://medicare.test:82/product/' + $('#e_prod_id').val(), {
                    name: $('#e_prod_name').val(),
                    description: $('#e_prod_desc').val(),
                })
                    .then(response => {
 
                        $("#update_prod_model").modal("hide");
                        //alert(response);
                        window.location.reload();
 
                    })
                    .catch(error => {
                        this.errors = [];
                        if (error.response.data.errors.name) {
                            this.errors.push(error.response.data.errors.name[0]);
                        }
 
                        if (error.response.data.errors.description) {
                            this.errors.push(error.response.data.errors.description[0]);
                        }
                    });
            }, */
        }
    }
</script>
<style>

</style>
