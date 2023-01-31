<script>

import axios from 'axios';

export default {
    name: 'App',
    data(){
        return{
            baseUrl: 'http://127.0.0.1:8000/api/',
            projects: []
        }
    },
    methods:{
        getApi(){
            axios.get(this.baseUrl + 'projects')
                .then(result => {
                    this.projects = result.data.projects
                })
        }
    },
    mounted(){
        this.getApi();
    }
}
</script>

<template>
    <div class="container">
        <h1 class="text-center">Questa è la Home di Vue</h1>
        <div class="d-flex flex-wrap">

            <div class="" v-for="project in this.projects" :key="project.id">

                <div class="card bg-dark text-light text-center" style="width: 18rem;">

                    <div class="card-body">
                        <h5 class="card-title">{{ project.name }}</h5>
                        <p class="card-text">{{project.summary}}</p>
                        <a href="#" class="btn btn-outline-info">Go</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>

</style>
