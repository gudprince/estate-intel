<template>
	<div>
		<div class="container mt-2">
		<div class="mb-2"><strong>Shapes</strong>	<strong @click="logout" class="float-end text-danger"><button>Logout</button></strong></div>
		</div>
		<div class="bg-light">
			<div class="container" >
				<h5 class="pt-4 left-margin">Filters</h5>
				<div class="text-primary py-2 left-margin">Shapes</div>
				<div class="d-flex align-content-start flex-wrap mb-3">
					<div 
						class="p-2 bd-highlight"
						v-for="(item, i) in allShapes"
						v-bind:key="i"
						@click="selectShape(item.value)"
					
					>
						<button 
							type="button" 
							class="btn btn-sm border-secondary rounded-pill"
							:class="shapeNames.includes(item.value)? 'bg-primary text-white': ''"
						>
							{{item.name}}
						</button>
					</div>

				</div>
				<div>
				<div class="text-primary py-2 left-margin">Colors</div>
					<div class="d-flex align-content-start flex-wrap mb-3">
						<div 
							class="p-2 bd-highlight"
							v-for="(item, i) in allColors"
							v-bind:key="i"
							@click="selectColor(item)"
							:class="shapeColors.includes(item)? 'border border-5 border-secondary': ''"
						>
							<div class="color-circle" :class="item"></div>
						</div>
						
					</div>
				</div>
				<div class="py-4"><strong>{{title}}:</strong> ({{fiteredShapes.length}})</div>
				<div class="row">
					<div class="col-4" v-for="shape in fiteredShapes" v-bind:key="shape.id">
						<div class="mb-4 bg-white" style="padding:30px">
							<div class="mx-auto" 
								:class="[shape.name, shape.name == 'triangle'?  shape.border_bottom : shape.color]"></div>
						</div>
					</div>
				
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import json from '../shapes.json';

export default{
	middleware: 'auth',
	data(){
		return{
			shapes: json,
			shapeNames: [],
			shapeColors: [],
			shapeLength: 0,
			allShapes: [
				{name: 'Oval' ,value: 'oval'},
				{name: 'Round' ,value: 'circle'},
				{name: 'Triangle' ,value: 'triangle'},
				{name: 'Square' ,value: 'square'},
				{name: 'Rectangle' ,value: 'rectangle'},
			],
			allColors: [
				'red',
				'blue',
				'green',
				'yellow',
				'sky_blue',
				'gray'
			]
		}
	},
	computed: {
		fiteredShapes(){
			let temShapes = this.shapes
			if(this.shapeNames.length > 0){
				temShapes = temShapes.filter((item)=>{
					return this.shapeNames.includes(item.name)
				})
			}
			if(this.shapeColors.length > 0){
				temShapes = temShapes.filter((item)=>{
					return this.shapeColors.includes(item.color)
				})
			}
			return temShapes;
		},
		title(){
			let title = '';
			if(this.shapes.length === this.fiteredShapes.length){
				title =  'All items'
			}
			if(this.allColors.length == this.shapeColors.length && 
				(this.shapeNames.length > 1 && this.shapeNames.length < this.allShapes.length)  ||
				this.allShapes.length == this.shapeNames.length && 
				(this.shapeColors.length > 1 && this.shapeColors.length < this.allColors.length)){
				title =  'Multiple items'
			}
			if(this.allShapes.length == this.shapeNames.length && this.shapeColors.length == 1){
				let color = this.shapeColors[0];
				title = `All ${color} items`
			}
			if(this.allColors.length == this.shapeColors.length && this.shapeNames.length == 1){
				let shape = this.shapeNames[0];
				title = `All ${shape} items`
			}
			if(	(this.shapeNames.length > 1 && this.shapeNames.length < this.allShapes.length)  &&
				this.shapeColors.length == 1){
				let color = this.shapeColors[0];
				title = `Multiple ${color} items`
			}
			if(	(this.shapeColors.length > 1 && this.shapeColors.length < this.allColors.length)  &&
				this.shapeNames.length == 1){
				let name = this.shapeNames[0];
				title = `Multiple ${name} items`
			}
			if(this.shapeColors.length == 1 && this.shapeNames.length ==1){
				let name = this.shapeNames[0];
				title = `${name} item`
			}
			if(	(this.shapeColors.length > 1 && this.shapeColors.length < this.allColors.length)  &&
				(this.shapeNames.length > 1 && this.shapeNames.length < this.allShapes.length)){
				let name = this.shapeNames[0];
				title = `Multiple items`
			}
			if(this.shapeColors.length == 1 && this.shapeNames.length == 0){
				let color = this.shapeColors[0];
				title = `All ${color} items`
			}
			if(this.shapeNames.length == 1 && this.shapeColors.length == 0){
				let name = this.shapeNames[0];
				title = `All ${name} items`
			}
			if((this.shapeNames.length > 1 && this.shapeNames.length < this.allShapes.length) == 1 && this.shapeColors.length == 0){
				title = `Multiple shape items`
			}
			if((this.shapeColors.length > 1 && this.shapeColors.length < this.allColors.length) == 1 && this.shapeNames.length == 0){
				let name = this.shapeNames[0];
				title = `Multiple color items`
			}
		
		
		
			return title
		}
	},
	methods: {
		selectShape(shape){
			let index = this.shapeNames.indexOf(shape);
			if(index === -1){
					this.shapeNames.push(shape);
			}
			else{
					this.shapeNames.splice(index,1);  
			}
		},
		selectColor(color){
			let index = this.shapeColors.indexOf(color);
			if(index === -1){
					this.shapeColors.push(color);
			}
			else{
					this.shapeColors.splice(index,1);  
			}
		},
		logout(){
      this.$cookies.remove('isLogin')
      this.$router.push('/');
    }
	},
	created(){
	}
}
</script>
