<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const amountInput = ref(null);

const form = useForm({
    amount: '',
    currency: '',
    payment_method: '',
    merchant_id: '',
    order_id: '',
});

const createTransaction = () => {
  Inertia.post('/api/transactions', form, {
    preserveScroll: true,
    onSuccess: () => form.reset(),
    // onError: () => {
    //     if (form.errors.password) {
    //         form.reset('password', 'password_confirmation');
    //         passwordInput.value.focus();
    //     }
    //     if (form.errors.amount) {
    //         form.reset('amount');
    //         amountInput.value.focus();
    //     }
    // },
  });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Create transaction</h2>
        </header>

        <form @submit.prevent="createTransaction" class="mt-6 space-y-6">
            <div>
              <InputLabel for="amount" value="Amount" />

              <TextInput
                id="amount"
                ref="amountInput"
                v-model="form.amount"
                type="number"
                class="mt-1 block w-full"
                autocomplete="amount"
              />

              <InputError :message="form.errors.amount" class="mt-2" />
            </div>
            
            <div>
              <InputLabel for="currency" value="Currency" />

              <TextInput
                id="currency"
                ref="currencyInput"
                v-model="form.currency"
                type="text"
                class="mt-1 block w-full"
                autocomplete="currency"
              />

              <InputError :message="form.errors.currency" class="mt-2" />
            </div>

            <div>
              <InputLabel for="payment_method" value="Payment Method ID" />

              <TextInput
                id="payment_method"
                ref="payment_methodInput"
                v-model="form.payment_method"
                type="number"
                class="mt-1 block w-full"
                autocomplete="payment_method"
              />

              <InputError :message="form.errors.payment_method" class="mt-2" />
            </div>

            <div>
              <InputLabel for="merchant_id" value="Merchant ID" />

              <TextInput
                id="merchant_id"
                ref="merchant_idInput"
                v-model="form.merchant_id"
                type="number"
                class="mt-1 block w-full"
                autocomplete="merchant_id"
              />

              <InputError :message="form.errors.merchant_id" class="mt-2" />
            </div>

            <div>
              <InputLabel for="order_id" value="Order ID" />

              <TextInput
                id="order_id"
                ref="order_idInput"
                v-model="form.order_id"
                type="text"
                class="mt-1 block w-full"
                autocomplete="order_id"
              />

              <InputError :message="form.errors.order_id" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Create</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Created.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
