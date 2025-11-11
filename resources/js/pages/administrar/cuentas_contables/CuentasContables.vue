    <template>

        <head title="Cuentas contables" />
        <AppLayout :breadcrumbs="breadcrumbs" style="background-color: #454545">
            <v-form style="padding: 10px;" @submit.prevent="submit">
                <v-row class="text-center">
                    <v-col cols="12">Cuentas contables</v-col>
                    <v-col cols="6">
                        <v-label>Código</v-label>
                        <v-text-field></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-label>Descripción</v-label>
                        <v-text-field></v-text-field>
                    </v-col>
                </v-row>
                <v-row class="text-center">
                    <v-col cols="12" class="d-flex justify-center">
                        <v-btn class="boton_verde_submit w-50" type="submit" @click="submit()">Añadir</v-btn>
                    </v-col>
                </v-row>
            </v-form>
        </AppLayout>
    </template>
<script setup>
import AppLayout from '@/layouts/AppLayout.vue';

const breadcrumbs = [
    {
        title: 'Cuentas contables',
        //href: viewCreateClients().url,
    },
];
const submit = () => {
    
}
</script>

<style>
.boton_verde_submit {
    background-color: #2aa134;
    padding: 25px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: rgb(236, 236, 236);
    font-size: medium;
}
</style>