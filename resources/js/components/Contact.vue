<template>
    <div>
        <h1 class="text-center">Agenda de contactos</h1>
        <hr>
        <!-- Button trigger modal -->
<button @click="update=false; openModal()" type="button" class="btn btn-primary">
  Nuevo Contacto
</button>

<!-- Modal -->
<div class="modal" :class="{show:modal}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{titleModal}}</h5>
        <button @click="closeModal()" type="button" class="close" aria-label="Close" ariel-label="Close"></button>
      </div>
      <div class="modal-body">
        <div>
            <label for="first_name">Nombre</label>
            <input v-model="contact.first_name" type="text" class="form-control" id="first_name" name="first_name" placeholder="Nombre de contacto">
            <label for="last_name">Apellido</label>
            <input v-model="contact.last_name" type="text" class="form-control" id="last_name" name="last_name" placeholder="Apellido de contacto">
            <label for="email">Email</label>
            <input v-model="contact.email" type="text" class="form-control" id="email" name="email" placeholder="Correo Electronico">
            <label for="phone">Telefono</label>
            <input v-model="contact.phone" type="text" class="form-control" id="phone" name="phone" placeholder="Telefono">
            <label for="address">Domicilio</label>
            <input v-model="contact.address" type="text" class="form-control" id="address" name="address" placeholder="Domicilio">
        </div>
      </div>
      <div class="modal-footer">
        <button @click="closeModal()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button @click="guardar()" type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
        
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Email</th>
            <th scope="col">Telefono</th>
            <th scope="col">Domicilio</th>
            <th scope="col" colspan="2" class="text-center">Acción</th>

            </tr>
        </thead>
        <tbody>
            <tr v-for="contact in contacts" :key="contact.id">
            <th scope="row">{{contact.id}}</th>
            <td>{{contact.first_name}}</td>
            <td>{{contact.last_name}}</td>
            <td>{{contact.email}}</td>
            <td>{{contact.phone}}</td>
            <td>{{contact.address}}</td>
            <td>
                <button class="btn btn-warning" @click="update=true; openModal(contact);">Editar</button>
            </td>
            <td>
                <button @click="eliminar(contact.id)" class="btn btn-danger">Eliminar</button>
            </td>
            </tr>
        </tbody>
    </table>
    </div>
</template>
<script>
export default {
       data () {
           return {
               contact:{
                   first_name:"",
                   last_name:"",
                   email:"",
                   phone:"",
                   address:"",
               },
               id:0,
               update:true,
               modal:0,
               titleModal:'',
               contacts:[],
               
           }
       },
       methods:{
           async list(){
                const res = await axios.get('contacts');
                this.contacts = res.data;
           },
           async eliminar(id) {
                const res = await axios.delete('/contacts/'+id);
                this.list(); // para retornar el metodo listar
           },
           async guardar(){
               if (this.update) {
                   const res = await axios.put('/contacts/'+this.id,this.contact);
               }else{
                   const res = await axios.post('/contacts',this.contact);
               }
               this.closeModal();
               this.list();
           },
           openModal(data={}){
               this.modal = 1;
               if (this.update) {
                   this.id = data.id;
                   this.titleModal = "Modificar contacto";
                   this.contact.first_name = data.first_name;
                   this.contact.last_name = data.last_name;
                   this.contact.email = data.email;
                   this.contact.phone = data.phone;
                   this.contact.address = data.address;
                   
               }else{
                   this.id = 0;
                   this.titleModal = "Crear Contacto";
                   this.contact.first_name = "";
                   this.contact.last_name = "";
                   this.contact.email = "";
                   this.contact.phone = "";
                   this.contact.address = "";
               }
           },
           closeModal(){
               this.modal = 0;
           }

       },
       created(){
           this.list();
       },
}
</script>
<style>
.show{
    display: list-item;
    opacity: 1;
    background: rgba(44, 38, 75, 0.849);
}
</style>
