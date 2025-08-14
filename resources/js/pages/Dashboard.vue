<script setup lang="ts">
import { CheckCircleIcon, XMarkIcon, InformationCircleIcon } from '@heroicons/vue/20/solid'
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { RotateCcw } from 'lucide-vue-next';
import { ref } from 'vue';

interface Quote {
    id: number;
    message: string;
    who: string;
    actor: string;
    createdAt: string;
}

interface Props {
    success?: string;
    quotes: Quote[];
}

defineProps<Props>();

const state = ref<{
    loading: boolean,
}>({
    loading: false,
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const generateQuote = () => {
    router.post(
        route('quotes.store')
    )
}

const refresh = () => {
    state.value.loading = true
    router.get(
        route('dashboard'), {}, {
        onFinish: () => state.value.loading = false,
        preserveScroll: true,
    }
    )
}

const dismiss = () => {
    refresh()
}
</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl">
            <div class="relative min-h-[100vh] flex-1 border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <div class="my-6 max-w-4xl mx-auto space-y-8">
                    <div class="space-y-2">
                        <div
                            class="rounded-md bg-blue-50 p-4 dark:bg-blue-500/10 dark:outline dark:outline-blue-500/20">
                            <div class="flex">
                                <div class="shrink-0">
                                    <InformationCircleIcon class="size-5 text-blue-400" aria-hidden="true" />
                                </div>
                                <div class="ml-3 flex-1 md:flex md:justify-between">
                                    <p class="text-sm text-blue-700 dark:text-blue-300">The scheduler will generate
                                        quote randomly every 5 minutes.</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="rounded-md bg-blue-50 p-4 dark:bg-blue-500/10 dark:outline dark:outline-blue-500/20">
                            <div class="flex">
                                <div class="shrink-0">
                                    <InformationCircleIcon class="size-5 text-blue-400" aria-hidden="true" />
                                </div>
                                <div class="ml-3 flex-1 md:flex md:justify-between">
                                    <p class="text-sm text-blue-700 dark:text-blue-300">Click the "Generate quote"
                                        button to generate through a background job.</p>
                                </div>
                            </div>
                        </div>
                        <div v-if="success"
                            class="rounded-md bg-green-50 p-4 dark:bg-green-500/10 dark:outline dark:outline-green-500/20">
                            <div class="flex">
                                <div class="shrink-0">
                                    <CheckCircleIcon class="size-5 text-green-400" aria-hidden="true" />
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800 dark:text-green-300">{{ success }}</p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <div class="-mx-1.5 -my-1.5">
                                        <button type="button" @click="dismiss"
                                            class="inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100 focus-visible:ring-2 focus-visible:ring-green-600 focus-visible:ring-offset-2 focus-visible:ring-offset-green-50 focus-visible:outline-hidden dark:bg-transparent dark:text-green-400 dark:hover:bg-green-500/10 dark:focus-visible:ring-green-500 dark:focus-visible:ring-offset-1 dark:focus-visible:ring-offset-green-900">
                                            <span class="sr-only">Dismiss</span>
                                            <XMarkIcon class="size-5" aria-hidden="true" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold text-gray-900 dark:text-white">Quotes</h1>
                            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">10 latest quotes are
                                generated by scheduler and background jobs.</p>
                        </div>
                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <span class="isolate inline-flex rounded-md shadow-xs dark:shadow-none">
                                <button title="Generate quote" @click="generateQuote" type="button"
                                    class="relative inline-flex items-center gap-x-1.5 rounded-l-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-gray-300 ring-inset hover:bg-gray-50 focus:z-10 dark:bg-white/10 dark:text-white dark:ring-gray-700 dark:hover:bg-white/20">
                                    Generate quote
                                </button>
                                <button title="Refresh" type="button" @click="refresh"
                                    class="relative -ml-px inline-flex items-center rounded-r-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-gray-300 ring-inset hover:bg-gray-50 focus:z-10 dark:bg-white/10 dark:text-white dark:ring-gray-700 dark:hover:bg-white/20">
                                    <RotateCcw
                                        :class="{ '-ml-0.5 size-5 text-gray-400 dark:text-gray-500': true, 'animate-spin': state.loading }"
                                        aria-hidden="true" />
                                </button>
                            </span>
                        </div>
                    </div>
                    <ul role="list"
                        class="divide-y divide-gray-100 dark:divide-white/5 border border-neutral-100 rounded-lg">
                        <li v-for="quote in quotes" :key="quote.id" class="flex justify-between gap-x-6 p-5">
                            <div class="flex min-w-0 gap-x-4">
                                <div class="min-w-0 flex-auto">
                                    <p class="font-medium text-gray-900 dark:text-white">{{ quote.message }}
                                    </p>
                                    <p class="mt-1 truncate text-sm/6 text-gray-500 dark:text-gray-400">-- {{ quote.who
                                    }} --</p>
                                </div>
                            </div>
                            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                <p class="text-sm/6 text-gray-900 dark:text-white font-medium">
                                    <span class="text-gray-500 text-xs">Generated by</span> {{ quote.actor }}
                                </p>
                                <p class="mt-1 text-xs/5 text-gray-500 dark:text-gray-400">
                                    {{ quote.createdAt }}
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
