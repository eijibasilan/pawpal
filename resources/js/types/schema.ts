import { CalendarDate } from '@internationalized/date';
export interface Role {
    id: number;
    name: string;
    guard_name: string;
    created_at: string;
    updated_at: string;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export interface Admin {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
    roles: Role[];
}

export interface VetService {
    id: number;
    name: string;
    description?: string;
    created_at: string;
    updated_at: string;
    types: VetServiceType[];
}

export interface VetServiceType {
    id: number;
    name: string;
    description?: string;
    created_at: string;
    updated_at: string;
    service: VetService;
}

export interface ProductCategory {
    id: number;
    name: string;
    description?: string;
    created_at: string;
    updated_at: string;
    products: Product[];
}

export interface Product {
    id: number;
    name: string;
    quantity: number;
    unit: string;
    created_at: string;
    updated_at: string;
    category: ProductCategory;
}

export interface VetAppointmentSchedule {
    id: number;
    scheduled_date: CalendarDate;
    start_time: string;
    end_time: string;
    doctor: Admin;
    service: VetService;
}
