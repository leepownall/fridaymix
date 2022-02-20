import React from 'react'

export default function Layout({ children }) {
    return (
        <main className='relative flex items-top justify-center min-h-screen sm:items-center py-4 sm:pt-0'>
            {children}
        </main>
    )
}
