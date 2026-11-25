import type { Component } from 'vue';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: Component;
    isActive?: boolean;
}

export interface SharedData {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: {
        location: string;
        url: string;
        port: null | number;
        defaults: Record<string, unknown>;
        routes: Record<string, string>;
    };
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    role: 'admin' | 'user';
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export interface Game {
    id: number,
    api_id: number;
    competition_id: number;
    competition?: {id: number; name: string}
    home_team: string;
    away_team: string;
    home_team_logo: string | null;
    away_team_logo: string | null;
    status: 'scheduled' | 'live' | 'finished' | 'postponed' | 'cancelled';
    kickoff_at: string;
    home_score: number;
    away_score: number;
    prediction_count?: number;
}

export interface Group {
    id: number;
    name: string;
    description: string | null;
    visibility: string;
    invitation_code: string;
    competition_id: number;
    created_by: number;
}

export type BreadcrumbItemType = BreadcrumbItem;
