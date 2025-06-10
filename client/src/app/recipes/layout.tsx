/* eslint-disable @typescript-eslint/no-require-imports */
"use client";
import Image from "next/image";
import Link from "next/link";
import React, { useEffect, useState } from "react";

// icons
import { PiHouseLight } from "react-icons/pi";
import { BiWorld } from "react-icons/bi";
import { usePathname } from "next/navigation";
import { useGetRecipes } from "@/hooks/useGetRecipes";
import { IoSearch } from "react-icons/io5";

type Props = {
  children: React.ReactNode;
};

export default function RecipesLayout({ children }: Props) {
  const pathname = usePathname();
  const { getRecipeCountries } = useGetRecipes();

  const [countries, set_countries] = useState([]);
  const [showCountries, set_showCountries] = useState(false);

  const effectFn = async () => {
    const response = await getRecipeCountries();
    set_countries(response);
  };
  useEffect(() => {
    effectFn();
  }, []);

  return (
    <div className="recipes-layout-section h-screen">
      <div className="drawer lg:drawer-open">
        <input id="my-drawer-3" type="checkbox" className="drawer-toggle" />
        <div className="drawer-content flex flex-col">
          {/* Mobile navbar */}
          <div className="navbar bg-base-300 lg:hidden">
            <div className="flex-none">
              <label
                htmlFor="my-drawer-3"
                aria-label="open sidebar"
                className="btn btn-square btn-ghost"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  className="inline-block h-6 w-6 stroke-current"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth="2"
                    d="M4 6h16M4 12h16M4 18h16"
                  ></path>
                </svg>
              </label>
            </div>
            <div className="mx-2 flex-1 px-2">Food Hub</div>
          </div>
          {/* Main content */}
          <div className="py-4">{children}</div>
        </div>
        <div className="drawer-side z-40">
          <label
            htmlFor="my-drawer-3"
            aria-label="close sidebar"
            className="drawer-overlay"
          ></label>
          <div className="menu min-h-full w-80 bg-base-200 p-4">
            <div className="nav-side">
              <div className="wrapper justify-center mt-10">
                <Image
                  src={require("@/images/utils/logo.png")}
                  height={27}
                  alt="logo"
                />
              </div>

              <div className="wrapper justify-center mt-12">
                <Link
                  href={"/recipes"}
                  className={
                    pathname === "/recipes" ? "nav-link-active" : "nav-link"
                  }
                >
                  <span className="pb-1">
                    <PiHouseLight className="nav-icons home" />
                  </span>
                  Home
                </Link>

                <div
                  className={
                    pathname.startsWith("/recipes/country")
                      ? "nav-link-active"
                      : "nav-link"
                  }
                  onClick={() => set_showCountries(!showCountries)}
                >
                  <span>
                    <BiWorld className="nav-icons country" />
                  </span>
                  Country
                </div>
                <ul
                  className={showCountries ? "pl-3 cursor-pointer" : "hidden"}
                >
                  {countries?.map((c: { country: string }, i) => {
                    return (
                      <li key={i}>
                        <Link href={`/recipes/country/${c?.country}`}>
                          {c?.country}
                        </Link>
                      </li>
                    );
                  })}
                </ul>

                <Link
                  href={"/recipes/ingredients-search"}
                  className={
                    pathname === "/recipes/ingredients-search"
                      ? "nav-link-active"
                      : "nav-link"
                  }
                >
                  <span>
                    <IoSearch className="nav-icons" />
                  </span>
                  Ingredient Search
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
