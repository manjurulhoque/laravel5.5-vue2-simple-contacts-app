<template>
    <div class="container">
        <div class="panel panel-success">
            <div class="panel-heading">Add Contact</div>

            <div class="panel-body">
                <form action="#" @submit.prevent="edit ? updateContact(contact.id): createContact()">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" v-model="contact.name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" v-model="contact.email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" v-model="contact.phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <button v-show="!edit" type="submit" class="btn btn-primary">New contact</button>
                        <button v-show="edit" type="submit" class="btn btn-primary">Update contact</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">All Contacts</div>

            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="c in contacts">
                        <td>{{ c.id }}</td>
                        <td>{{ c.name }}</td>
                        <td>{{ c.phone }}</td>
                        <td>{{ c.email }}</td>
                        <td>
                            <button class="btn btn-primary btn-xs">Edit contact</button>
                            <button class="btn btn-danger btn-xs">Delete contact</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                edit: false,
                contacts: [],
                contact: {
                    id: '',
                    name: '',
                    email: '',
                    phone: ''
                },
                url: 'api/contacts/'
            }
        },
        mounted() {
            this.fetContacts();
        },
        methods: {
            fetContacts() {
                axios.get(this.url)
                    .then(response => {
                        console.log(response);
                        this.contacts = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            createContact() {
                let data = Object.assign({}, this.contact);
                axios.post(this.url + 'store', data)
                    .then(response => {
                        console.log(response);
                        this.contact.name = '';
                        this.contact.email = '';
                        this.contact.phone = '';
                        this.edit = false;
                        this.fetContacts();
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            updateContact(id){

            }
        }
    }
</script>
