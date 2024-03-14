<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
</script>
<template>
    <AppLayout title="Subscription">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Subscription
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                       <!-- sss  {{ $page.props.plans }} -->
                       <form action="subscribe" method="POST" id="subscribe-form">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"  v-for="plan in $page.props.plans" :key="plan.id">
                                    <div class="subscription-option">
                                        <input type="radio" id="plan-silver" name="plan" value='{{ plan->id }}'>
                                        <label for="plan-silver">
                                            <span class="plan-price">{{plan.currency}}{{plan.amount/100}}<small> /{{ plan.interval}}</small></span>
                                            <span class="plan-name">{{ plan.product.name}}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input id="card-holder-name" type="text"><br><label for="card-holder-name">Card Holder Name</label>
                        <div class="form-row">
                            <label for="card-element">Credit or debit card</label>
                            <div id="card-element" class="form-control">
                            </div>
                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <div class="stripe-errors"></div>
                        <div v-if="$page.props.errors" class="alert alert-danger">
                            {{ errors }}<br>
                        </div>
                        <div class="form-group text-center">
                            <button  id="card-button" data-secret="{{ $page.props.intent.client_secret }}" class="btn btn-lg btn-success btn-block">SUBMIT</button>
                        </div>
                    </form>
                    </div>           
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
export default {
  data() {
    return {
      formData: {
        name: '',
        email: '',
      },
    };
  },
  methods: {
    submitForm() {
      // Handle form submission
      this.$inertia.post('/subscribe', this.formData);
    },
  },
};
</script>