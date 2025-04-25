<script setup lang="ts" generic="TData, TValue">
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { PaginationResponse } from '@/types';
import { router } from '@inertiajs/vue3';
import type { ColumnDef } from '@tanstack/vue-table';
import {
    FlexRender,
    getCoreRowModel,
    getExpandedRowModel,
    getFilteredRowModel,
    getPaginationRowModel,
    getSortedRowModel,
    useVueTable,
} from '@tanstack/vue-table';
import { ChevronLeft, ChevronRight, ChevronsLeft, ChevronsRight } from 'lucide-vue-next';
import { ref } from 'vue';
import Button from './ui/button/Button.vue';

const props = defineProps<{
    noDataText?: string;
    columns: ColumnDef<TData, TValue>[];
    pagination: PaginationResponse<TData>;
    additionalParams?: Record<string, any>;
}>();

const sorting = ref<any[]>([]);
const pageSizes = ref([1, 2, 3, 5, 10, 15, 30, 40, 50, 100]);
const paginationPayload = ref({
    pageIndex: props.pagination.current_page - 1,
    pageSize: props.pagination.per_page,
});

const table = useVueTable({
    pageCount: props.pagination.last_page,
    get data() {
        return props.pagination.data;
    },
    get columns() {
        return props.columns;
    },
    getCoreRowModel: getCoreRowModel(),
    getSortedRowModel: getSortedRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
    getFilteredRowModel: getFilteredRowModel(),
    getExpandedRowModel: getExpandedRowModel(),
    manualPagination: true,
    manualSorting: true,
    manualFiltering: true,
    onPaginationChange: (updater) => {
        if (typeof updater === 'function') {
            paginationPayload.value = updater(paginationPayload.value);
        } else {
            paginationPayload.value = updater;
        }
        router.get(props.pagination.path, {
            page: paginationPayload.value.pageIndex + 1,
            perPage: paginationPayload.value.pageSize,
            sortField: sorting.value[0]?.id,
            sortDirection: sorting.value.length == 0 ? undefined : sorting.value[0]?.desc ? 'desc' : 'asc',
            ...props?.additionalParams,
        });
    },
    onSortingChange: (updaterOrValue) => {
        if (typeof updaterOrValue === 'function') {
            sorting.value = updaterOrValue(sorting.value);
        } else {
            sorting.value = updaterOrValue;
        }

        router.get(props.pagination.path, {
            page: paginationPayload.value.pageIndex + 1,
            perPage: paginationPayload.value.pageSize,
            sortField: sorting.value[0]?.id,
            sortDirection: sorting.value.length == 0 ? undefined : sorting.value[0]?.desc ? 'desc' : 'asc',
        });
    },
    state: {
        get pagination() {
            return paginationPayload.value;
        },
        get sorting() {
            return sorting.value;
        },
    },
});
</script>

<template>
    <div>
        <div class="mt-2 rounded-md border">
            <Table>
                <TableHeader>
                    <TableRow v-for="headerGroup in table.getHeaderGroups()" :key="headerGroup.id">
                        <TableHead v-for="header in headerGroup.headers" :key="header.id">
                            <FlexRender v-if="!header.isPlaceholder" :render="header.column.columnDef.header" :props="header.getContext()" />
                        </TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <template v-if="table.getRowModel().rows?.length">
                        <TableRow v-for="row in table.getRowModel().rows" :key="row.id" :data-state="row.getIsSelected() ? 'selected' : undefined">
                            <TableCell v-for="cell in row.getVisibleCells()" :key="cell.id">
                                <FlexRender :render="cell.column.columnDef.cell" :props="cell.getContext()" />
                            </TableCell>
                        </TableRow>
                    </template>
                    <template v-else>
                        <TableRow>
                            <TableCell :colspan="columns.length" class="h-24 text-center"> {{ props.noDataText ?? 'No results found.' }} </TableCell>
                        </TableRow>
                    </template>
                </TableBody>
            </Table>
        </div>
        <div class="flex items-center justify-end space-x-2 py-4">
            <div class="flex-1 text-sm text-muted-foreground">Page {{ props.pagination.current_page }} of {{ props.pagination.last_page }}.</div>
            <div class="flex items-center space-x-2">
                <p class="text-sm font-medium">Rows per page</p>
                <Select
                    :model-value="table.getState().pagination.pageSize.toString()"
                    @update:model-value="(value: any) => table.setPageSize(Number(value))"
                >
                    <SelectTrigger class="h-8 w-[70px]">
                        <SelectValue :placeholder="table.getState().pagination.pageSize.toString()" />
                    </SelectTrigger>
                    <SelectContent side="top">
                        <SelectItem v-for="pageSize in pageSizes" :key="pageSize" :value="pageSize.toString()">
                            {{ pageSize }}
                        </SelectItem>
                    </SelectContent>
                </Select>
            </div>
            <div class="space-x-2">
                <div class="flex items-center space-x-2">
                    <Button
                        variant="outline"
                        class="hidden h-8 w-8 p-0 lg:flex"
                        :disabled="!table.getCanPreviousPage()"
                        @click="table.setPageIndex(0)"
                    >
                        <ChevronsLeft class="h-4 w-4" />
                    </Button>
                    <Button variant="outline" class="h-8 w-8 p-0" :disabled="!table.getCanPreviousPage()" @click="table.previousPage()">
                        <ChevronLeft class="h-4 w-4" />
                    </Button>
                    <Button variant="outline" class="h-8 w-8 p-0" :disabled="!table.getCanNextPage()" @click="table.nextPage()">
                        <ChevronRight class="h-4 w-4" />
                    </Button>
                    <Button
                        variant="outline"
                        class="hidden h-8 w-8 p-0 lg:flex"
                        :disabled="!table.getCanNextPage()"
                        @click="table.setPageIndex(table.getPageCount() - 1)"
                    >
                        <ChevronsRight class="h-4 w-4" />
                    </Button>
                </div>
            </div>
        </div>
    </div>
</template>
