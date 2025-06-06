export interface Upload {
    id: number;
    file_name: string;
    file_extension: string;
    file_type?: string;
    url: string;
    created_at: string;
    updated_at: string;
}

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
    mobile_number: string;
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
    uploads: Upload[];
}

export interface VetServiceType {
    id: number;
    name: string;
    description?: string;
    quantity: number;
    created_at: string;
    updated_at: string;
    service: VetService;
}

export interface ProductBrand {
    id: number;
    name: string;
    description?: string;
    created_at: string;
    updated_at: string;
    products: Product[];
    upload: Upload;
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
    description: string;
    quantity: number;
    price: number;
    created_at: string;
    updated_at: string;
    brand: ProductBrand;
    category: ProductCategory;
    uploads: Upload[];
}

export interface VetAppointmentSchedule {
    id: number;
    scheduled_date: string;
    start_time: string;
    end_time: string;
    created_at: string;
    updated_at: string;
    doctor: Admin;
    service: VetService;
}
export interface VetAppointment {
    id: number;
    details: string;
    status: 'Pending' | 'Confirmed';
    created_at: string;
    updated_at: string;
    user: User;
    schedule: VetAppointmentSchedule;
}

export interface Notification {
    id: number;
    type: string;
    notifiable_id: number;
    notifiable_type: string;
    data: [key: any];
    read_at: string;
    created_at: string;
    updated_at: string;
}
