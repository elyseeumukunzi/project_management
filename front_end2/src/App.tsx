import { useState } from 'react';
import './App.css';
import { Button } from './components/ui/button';
import { AppBar } from './AppBar';
import { AuthProvider } from '@/context/AuthContext';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import Login from "@/pages/Login";
import Register from "@/pages/Register";
import Dashboard from "@/pages/Dashboard";
import { Home } from '@/pages/Home';

function App() {
  const [count, setCount] = useState(0)

  return (
    <>

      <AuthProvider>
        <BrowserRouter>
          <header className="sticky top-0 z-50 bg-white border-b shadow-sm">
            <div className="container mx-auto flex items-center justify-between py-4 px-4 md:px-6">
              <AppBar />
            </div>
          </header>
          <Routes>
            <Route path="/home" element={<Home />} />
            <Route path="/login" element={<Login />} />
            <Route path="/register" element={<Register />} />
            <Route path="/dashboard" element={<Dashboard />} />
          </Routes>


        </BrowserRouter>
      </AuthProvider>



    </>
  )
}

export default App
