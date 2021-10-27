<template>
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                <div class="card rounded-0">
                    <div class="card-body">
                        <!-- TABS -->
                        <ul class="nav nav-pills mb-3">
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{ name: 'notes' }">NOTES</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{ name: 'tags' }">TAGS</router-link>
                            </li>
                        </ul>

                        <div>
                            <router-view></router-view>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
