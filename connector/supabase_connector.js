// Pastikan library Supabase dari CDN sudah di-load di HTML sebelum file ini dipanggil
const SUPABASE_URL = 'https://hovevsqsloodajwftcpb.supabase.co';
const SUPABASE_ANON_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImhvdmV2c3FzbG9vZGFqd2Z0Y3BiIiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODEwNzU4ODksImV4cCI6MjA5NjY1MTg4OX0.HTtzplxTQfuHhiG83qhiAbR4h5HYl9PwUD8uIrhZdSw';

// Buat variabel global agar bisa dipakai di semua file HTML
const supabaseClient = window.supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);