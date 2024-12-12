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
    <div className="recipes-layout-section">
      <div className="wrapper">
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
            <ul className={showCountries ? "pl-3 cursor-pointer" : "hidden"}>
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
        <div className="content-side overflow-auto">{children}</div>
      </div>
    </div>
  );
}
