import {
    NavigationMenu,
    NavigationMenuContent,
    NavigationMenuIndicator,
    NavigationMenuItem,
    NavigationMenuLink,
    NavigationMenuList,
    NavigationMenuTrigger,
    NavigationMenuViewport,
} from "@/components/ui/navigation-menu"
import { Link } from "react-router-dom";
import React from "react";


export function AppBar() {
    return (
        <NavigationMenu className="px-6 py-3  bg-white">
            <NavigationMenuList className="flex gap-6">
                <NavigationMenuItem>
                    <NavigationMenuLink asChild>
                        <Link to="/" className="font-medium text-gray-800 hover:text-black">
                            Home
                        </Link>
                    </NavigationMenuLink>
                </NavigationMenuItem>

                <NavigationMenuItem>
                    <NavigationMenuLink asChild>
                        <Link to="/login" className="font-medium text-gray-800 hover:text-black">
                            Login
                        </Link>
                    </NavigationMenuLink>
                </NavigationMenuItem>

                <NavigationMenuItem>
                    <NavigationMenuLink asChild>
                        <Link to="/register" className="font-medium text-gray-800 hover:text-black">
                            Register
                        </Link>
                    </NavigationMenuLink>
                </NavigationMenuItem>

                
            </NavigationMenuList>
        </NavigationMenu>

    )
}


