FROM node:18 as build

# Install dependencies
RUN apt-get update && apt-get install -y \
    vim \
    zip \
    unzip \
    curl

WORKDIR /var/www
COPY . .

# В таком варианте не работало
# COPY package.json .
# COPY package-lock.json .

RUN npm install
RUN npm run build


FROM nginx 
COPY --from=build /var/www/dist usr/share/nginx/html

# CMD ["nginx", "-g", "daemon off"]