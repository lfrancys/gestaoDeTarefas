# Set the base image
FROM node:20

# Set working directory
WORKDIR /var/www

# Copy `package.json` and `package-lock.json`
COPY package*.json ./

# Copy .config.js files to the working directory
COPY *config.js ./

# Install project dependencies
RUN npm cache clean --force
RUN rm -rf node_modules package-lock.json
RUN npm install

# Copy project files into the docker image
COPY . .

# Initialize Tailwind CSS
RUN npx tailwindcss init -p
RUN npm i

# Expose the port Vite runs on
EXPOSE 3000

# Start the Vite server
CMD ["npm", "run", "dev"]
