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
}

export interface Service {
    id: number;
    name: string;
    description?: string;
    created_at: string;
    updated_at: string;
}

export interface ProductCategory {
    id: number;
    name: string;
    description?: string;
    products: Product[];
    created_at: string;
    updated_at: string;
}

export interface Product {
    id: number;
    name: string;
    quantity: number;
    unit: string;
    category: ProductCategory;
    created_at: string;
    updated_at: string;
}
