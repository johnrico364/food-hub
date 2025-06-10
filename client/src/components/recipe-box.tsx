"use client";
import { useRouter } from "next/navigation";
import Image from "next/image";

type Props = {
  id: number;
  name: string;
  description: string;
  image: string;
};

export function RecipeBox(data: Props) {
  const router = useRouter();
  return (
    <div className="recipe-box w-[14rem] h-[19.8rem] p-1">
      <div className="card bg-base-100">
        <figure className="ml-[0.18rem] h-[150px] w-[13rem] relative overflow-hidden">
          <Image
            className="rounded-xl object-contain"
            src={`http://127.0.0.1:8000/api/image/${data?.image}`}
            alt="recipes"
            layout="fill"
            objectFit="cover"
          />
        </figure>
        <div className="recipe-details items-center">
          <div className="recipe-name">{data.name}</div>

          <div className="recipe-desc">{data.description}</div>
          <div className="text-center">
            <button
              className="recipe-btn w-full"
              onClick={() => router.push(`/details/${data?.id}`)}
            >
              Show Recipe
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}
