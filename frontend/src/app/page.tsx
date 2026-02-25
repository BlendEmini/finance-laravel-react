"use client";

import { useEffect, useState } from "react";

const API_URL = process.env.NEXT_PUBLIC_API_URL || "http://localhost:8000";

export default function Home() {
  const [apiStatus, setApiStatus] = useState<string | null>(null);
  const [apiError, setApiError] = useState<string | null>(null);

  useEffect(() => {
    fetch(`${API_URL}/api/health`)
      .then((res) => res.json())
      .then((data) => setApiStatus(data.message))
      .catch((err) => setApiError(err.message));
  }, []);

  return (
    <div className="flex min-h-screen flex-col items-center justify-center gap-8 bg-zinc-50 p-8 font-sans dark:bg-zinc-950">
      <h1 className="text-3xl font-bold text-zinc-900 dark:text-zinc-50">
        Finance App
      </h1>
      <p className="text-zinc-600 dark:text-zinc-400">
        Laravel API + Next.js TypeScript
      </p>
      <div className="rounded-lg border border-zinc-200 bg-white px-6 py-4 dark:border-zinc-800 dark:bg-zinc-900">
        <p className="text-sm text-zinc-500">API status:</p>
        {apiStatus && (
          <p className="mt-1 text-green-600 dark:text-green-400">{apiStatus}</p>
        )}
        {apiError && (
          <p className="mt-1 text-red-600 dark:text-red-400">
            Backend not reachable. Start Laravel: <code className="rounded bg-zinc-100 px-1 dark:bg-zinc-800">cd backend && php artisan serve</code>
          </p>
        )}
        {!apiStatus && !apiError && (
          <p className="mt-1 text-zinc-500">Checking...</p>
        )}
      </div>
    </div>
  );
}
