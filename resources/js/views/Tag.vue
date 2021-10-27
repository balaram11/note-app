<template>
    <div>
        <!-- Tag Form -->
        <form @submit.prevent="addTag">
            <div class="row">
                <div class="col-md-5">
                    <input type="text" v-model="form.tagName" class="form-control rounded-0">
                    <span v-if="errors.tagName" class="text-danger">{{ errors.tagName[0] }}</span>
                </div>
                <div class="col-md-5">
                    <button type="submit" class="btn btn-outline-primary">Add Tag</button>
                </div>
            </div>
        </form>

        <!-- Tag list -->
        <div class="row">
            <div class="col-md-12">
                <table class="table table-borderless w-50">
                    <tbody>
                        <tr v-for="tag in tags" :key="tag.id">
                            <td>{{tag.tag_name}}</td>
                            <td>
                                <a href="javascript:void(0)" @click="deleteTag(tag.id)">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Tag",
    data() {
        return {
            errors:[],
            tags: [],
            form:{
                tagName:null
            }
        }
    },
    created() {
        this.getTags();
    },
    methods: {
        getTags() {
            console.log();
            axios.get(BASE_URL + '/api/tags')
                .then(response => {
                    this.tags = response.data;
                }).catch(error=>{
                    console.log(error.response)
                });
        },
        deleteTag(id) {
            axios.delete(BASE_URL +'/api/delete/tag/' + id).then(response=>{
                console.log(response.data)
                this.getTags();
            }).catch(error=>{
                console.log(error.response)
            });
        },
        addTag() {
            axios.post(BASE_URL + '/api/add/tag',this.form).then(response => {
                this.form.tagName=null
                this.errors = []
                this.getTags()
            }).catch(error=>{
                if(error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
            });
        }
    }
}
</script>

<style scoped>

</style>